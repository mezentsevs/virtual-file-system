import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useFoldersStore = defineStore('folders', () => {
    const folders = ref([]);

    function getFolderById() {
        return id => findFolder(id, folders.value);
    }

    async function loadFolders() {
        const response = await axios.get('/api/folders');

        if (response.status === 200) {
            if (response.data.success === true) { folders.value = response.data.folders; }

            return response.data;
        }
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
        getFolderById,
        loadFolders,
    };
});
