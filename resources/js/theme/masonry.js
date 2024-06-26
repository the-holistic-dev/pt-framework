const masonryGrid = document.querySelector(".masonry-grid");
if (masonryGrid) {
    new masonry(masonryGrid, {
        itemSelector: ".masonry-item",
        percentPosition: true,
    });
}
