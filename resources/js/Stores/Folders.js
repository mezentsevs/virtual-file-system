import { defineStore } from 'pinia';
import { ref } from 'vue';
import { compareByName } from '@/Helpers/SortHelper.js';

export const useFoldersStore = defineStore('folders', () => {
    const folders = ref([]);

    function getFolderById() {
        return payload => findFolder(payload.id, folders.value);
    }

    function getFileById() {
        return payload => findFile(payload.id, folders.value);
    }

    async function loadFolders() {
        const response = await axios.get('/api/folders');

        if (response.status === 200 && response.data.success === true) {
            folders.value = response.data.folders;

            sortChildrenFolders(folders.value);
        }
    }

    function createFolder() {
        return async payload => {
            try {
                const response = await axios.post('/api/folders', payload);

                if (response.status === 200 && response.data.success === true) {
                    const parentChildrenFolders = getFolderById()({ id: response.data.folder.folder_id }).children_folders;

                    response.data.folder.children_folders = [];

                    response.data.folder.files = [];

                    parentChildrenFolders.push(response.data.folder);

                    parentChildrenFolders.sort(compareByName);

                    return response.data;
                }
            } catch (error) {
                if (error.status === 422) { return error.response.data; }
            }
        };
    }

    function createFile() {
        //
    }

    function updateFolderById() {
        return async payload => {
            try {
                const response = await axios.patch(`/api/folders/${payload.id}`, {
                    name: payload.name,
                });

                if (response.status === 200 && response.data.success === true) {
                    const folder = getFolderById()({ id: response.data.folder.id });

                    folder.name = response.data.folder.name;

                    if (folder.folder_id) {
                        const parentChildrenFolders = getFolderById()({ id: folder.folder_id }).children_folders;

                        parentChildrenFolders.sort(compareByName);
                    }

                    return response.data;
                }
            } catch (error) {
                if (error.status === 422) { return error.response.data; }
            }
        };
    }

    function updateFileById() {
        return async payload => {
            try {
                const response = await axios.patch(`/api/files/${payload.id}`, {
                    name: payload.name,
                    content: payload.content,
                });

                if (response.status === 200 && response.data.success === true) {
                    const file = getFileById()({ id: response.data.file.id });

                    file.name = response.data.file.name;
                    file.content = response.data.file.content;
                    file.size = response.data.file.size;

                    const parentFiles = getFolderById()({ id: file.folder_id }).files;

                    parentFiles.sort(compareByName);

                    return response.data;
                }
            } catch (error) {
                if (error.status === 422) { return error.response.data; }
            }
        };
    }

    function deleteFolderById() {
        return async payload => {
            const response = await axios.delete(`/api/folders/${payload.id}`);

            if (response.status === 200 && response.data.success === true) {
                const parentChildrenFolders = getFolderById()({ id: response.data.folder.folder_id }).children_folders;

                const index = parentChildrenFolders.findIndex(folder => folder.id === response.data.folder.id);

                if (index !== -1) { parentChildrenFolders.splice(index, 1); }

                return response.data;
            }
        };
    }

    function deleteFileById() {
        return async payload => {
            const response = await axios.delete(`/api/files/${payload.id}`);

            if (response.status === 200 && response.data.success === true) {
                const parentFiles = getFolderById()({ id: response.data.file.folder_id }).files;

                const index = parentFiles.findIndex(file => file.id === response.data.file.id);

                if (index !== -1) { parentFiles.splice(index, 1); }

                return response.data;
            }
        };
    }

    function findFolder(id, folders) {
        for (const folder of folders) {
            if (folder.id === id) { return folder; }

            if (folder.children_folders) {
                const childFolder = findFolder(id, folder.children_folders);

                if (childFolder) { return childFolder; }
            }
        }
    }

    function findFile(id, folders) {
        for (const folder of folders) {
            if (folder.files) {
                const file = folder.files.find(file => file.id === id);

                if (file) { return file; }
            }

            if (folder.children_folders) {
                const childFile = findFile(id, folder.children_folders);

                if (childFile) { return childFile; }
            }
        }
    }

    function sortChildrenFolders(folders) {
        for (const folder of folders) {
            if (folder.files) { folder.files.sort(compareByName); }

            if (!folder.children_folders) { return; }

            folder.children_folders.sort(compareByName);

            sortChildrenFolders(folder.children_folders);
        }
    }

    return {
        folders,
        getFolderById,
        loadFolders,
        createFolder,
        createFile,
        updateFolderById,
        updateFileById,
        deleteFolderById,
        deleteFileById,
    };
});
