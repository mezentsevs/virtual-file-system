import { computed, ref } from 'vue';
import { defineStore } from 'pinia';

import { compareByName } from '@/Helpers/SortHelper.js';

export const useFoldersStore = defineStore('folders', () => {
    const folders = ref([]);

    const getFolderById = computed(() => payload => findFolder(payload.id, folders.value));

    const getFileById = computed(() => payload => findFile(payload.id, folders.value));

    const loadFolders = async () => {
        const response = await axios.get('/api/folders');

        if (response.status === 200 && response.data.success === true) {
            folders.value = response.data.folders;

            sortChildren(folders.value);
        }
    };

    const createFolder = async payload => {
        try {
            const response = await axios.post('/api/folders', payload);

            if (response.status === 200 && response.data.success === true) {
                const parent = getFolderById.value({ id: response.data.folder.folder_id });

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
            if (error.status === 422) {
                return error.response.data;
            }
        }
    };

    const createFile = async payload => {
        try {
            const response = await axios.post('/api/files', payload);

            if (response.status === 200 && response.data.success === true) {
                const parent = getFolderById.value({ id: response.data.file.folder_id });

                parent.files.push(response.data.file);
                parent.files.sort(compareByName);
                parent.files_count++;

                updateParentsSize(
                    response.data.file.type,
                    response.data.file.id,
                    folders.value,
                    response.data.file.size,
                );

                return response.data;
            }
        } catch (error) {
            if (error.status === 422) {
                return error.response.data;
            }
        }
    };

    const updateFolderById = async payload => {
        try {
            const response = await axios.patch(`/api/folders/${payload.id}`, {
                name: payload.name,
            });

            if (response.status === 200 && response.data.success === true) {
                const folder = getFolderById.value({ id: response.data.folder.id });

                folder.name = response.data.folder.name;

                if (folder.folder_id) {
                    const parentChildrenFolders = getFolderById.value({
                        id: folder.folder_id,
                    }).children_folders;

                    parentChildrenFolders.sort(compareByName);
                }

                return response.data;
            }
        } catch (error) {
            if (error.status === 422) {
                return error.response.data;
            }
        }
    };

    const updateFileById = async payload => {
        try {
            const response = await axios.patch(`/api/files/${payload.id}`, {
                name: payload.name,
                content: payload.content,
            });

            if (response.status === 200 && response.data.success === true) {
                const file = getFileById.value({ id: response.data.file.id });

                updateParentsSize(
                    response.data.file.type,
                    response.data.file.id,
                    folders.value,
                    response.data.file.size - file.size,
                );

                file.name = response.data.file.name;
                file.content = response.data.file.content;
                file.size = response.data.file.size;

                const parentFiles = getFolderById.value({ id: file.folder_id }).files;

                parentFiles.sort(compareByName);

                return response.data;
            }
        } catch (error) {
            if (error.status === 422) {
                return error.response.data;
            }
        }
    };

    const deleteFolderById = async payload => {
        const response = await axios.delete(`/api/folders/${payload.id}`);

        if (response.status === 200 && response.data.success === true) {
            const size = getFolderById.value({ id: response.data.folder.id }).size;
            updateParentsSize(
                response.data.folder.type,
                response.data.folder.id,
                folders.value,
                -size,
            );

            const parent = getFolderById.value({ id: response.data.folder.folder_id });
            const index = parent.children_folders.findIndex(
                folder => folder.id === response.data.folder.id,
            );
            if (index !== -1) {
                parent.children_folders.splice(index, 1);
            }

            parent.folders_count--;

            return response.data;
        }
    };

    const deleteFileById = async payload => {
        const response = await axios.delete(`/api/files/${payload.id}`);

        if (response.status === 200 && response.data.success === true) {
            updateParentsSize(
                response.data.file.type,
                response.data.file.id,
                folders.value,
                -response.data.file.size,
            );

            const parent = getFolderById.value({ id: response.data.file.folder_id });
            const index = parent.files.findIndex(file => file.id === response.data.file.id);
            if (index !== -1) {
                parent.files.splice(index, 1);
            }

            parent.files_count--;

            return response.data;
        }
    };

    const findFolder = (id, folders) => {
        for (const folder of folders) {
            if (folder.id === id) {
                return folder;
            }

            if (folder.children_folders) {
                const childFolder = findFolder(id, folder.children_folders);

                if (childFolder) {
                    return childFolder;
                }
            }
        }
    };

    const findFile = (id, folders) => {
        for (const folder of folders) {
            if (folder.files) {
                const file = folder.files.find(file => file.id === id);

                if (file) {
                    return file;
                }
            }

            if (folder.children_folders) {
                const childFile = findFile(id, folder.children_folders);

                if (childFile) {
                    return childFile;
                }
            }
        }
    };

    const sortChildren = folders => {
        for (const folder of folders) {
            if (folder.files) {
                folder.files.sort(compareByName);
            }

            if (!folder.children_folders) {
                return;
            }

            folder.children_folders.sort(compareByName);

            sortChildren(folder.children_folders);
        }
    };

    const updateParentsSize = (type, id, folders, correction) => {
        if (correction === 0) {
            return;
        }

        const currentItem = type === 'folder' ? findFolder(id, folders) : findFile(id, folders);

        const parent = findFolder(currentItem.folder_id, folders);

        if (!parent) {
            return;
        }

        parent.size += correction;

        updateParentsSize(parent.type, parent.id, folders, correction);
    };

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
