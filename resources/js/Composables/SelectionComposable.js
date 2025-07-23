export const useSelection = () => {
    const clearSelection = () => document.querySelectorAll('.folder, .file')
        .forEach(el => el.classList.remove('selected'));

    const setSelected = $el => {
        if ($el.classList.value.includes('selected')) { return; }

        clearSelection();

        $el.classList.add('selected');
    };

    return { setSelected };
};
