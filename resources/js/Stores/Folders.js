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
                    const parent = getFolderById()({ id: response.data.folder.folder_id });

                    response.data.folder.children_folders = [];
                    response.data.folder.files = [];
                    response.data.folder.folders_count = 0;
                    response.data.folder.files_count = 0;

                    parent.children_folders.push(response.data.folder);
                    parent.children_folders.sort(compareByName);
                    parent.folders_count++;

                    return response.data;
                }
            } catch (error) {
                if (error.status === 422) { return error.response.data; }
            }
        };
    }

    function createFile() {
        return async payload => {
            try {
                const response = await axios.post('/api/files', payload);

                if (response.status === 200 && response.data.success === true) {
                    const parent = getFolderById()({ id: response.data.file.folder_id });

                    parent.files.push(response.data.file);
                    parent.files.sort(compareByName);
                    parent.files_count++;

                    return response.data;
                }
            } catch (error) {
                if (error.status === 422) { return error.response.data; }
            }
        };
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
                const parent = getFolderById()({ id: response.data.folder.folder_id });

                const index = parent.children_folders.findIndex(folder => folder.id === response.data.folder.id);

                if (index !== -1) { parent.children_folders.splice(index, 1); }

                parent.folders_count--;

                return response.data;
            }
        };
    }

    function deleteFileById() {
        return async payload => {
            const response = await axios.delete(`/api/files/${payload.id}`);

            if (response.status === 200 && response.data.success === true) {
                const parent = getFolderById()({ id: response.data.file.folder_id });

                const index = parent.files.findIndex(file => file.id === response.data.file.id);

                if (index !== -1) { parent.files.splice(index, 1); }

                parent.files_count--;

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
