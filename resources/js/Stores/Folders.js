import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useFoldersStore = defineStore('folders', () => {
    const folders = ref([]);

    function getFolderById() {
        return payload => findFolder(payload.id, folders.value);
    }

    async function loadFolders() {
        const response = await axios.get('/api/folders');

        if (response.status === 200 && response.data.success === true) { folders.value = response.data.folders; }
    }

    function createFolder() {
        return async payload => {
            try {
                const response = await axios.post('/api/folders', payload);

                if (response.status === 200 && response.data.success === true) {
                    const parentChildrenFolders = getFolderById()({ id: response.data.folder.folder_id }).children_folders;

                    response.data.folder.children_folders = [];

                    parentChildrenFolders.push(response.data.folder);

                    parentChildrenFolders.sort((a, b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));

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

    return {
        folders,
        loadFolders,
        createFolder,
        deleteFolderById,
    };
});
