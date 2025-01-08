import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useFoldersStore = defineStore('folders', () => {
    const folders = ref([]);

    async function fetchFolders() {
        const response = await axios.get('/api/folders');

        folders.value = response.data;
    }

    return {
        folders,
        fetchFolders,
    };
});
