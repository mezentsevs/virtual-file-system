export const getNextSiblingBySelector = (element, selector) => {
    let sibling = element.nextElementSibling;

    while (sibling) {
        if (sibling.matches(selector)) {
            return sibling;
        }

        sibling = sibling.nextElementSibling;
    }
};
