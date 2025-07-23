export const useClearSelection = () => {
    const clearSelection = () => document.querySelectorAll('.folder, .file')
        .forEach(el => el.classList.remove('selected'));

    return { clearSelection };
};
