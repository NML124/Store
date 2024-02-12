(() => {
    fetch("https://pixabay.com/api/?key=37961660-96e6e2efde82126fbcb9618e0&q=yellow+flowers&image_type=photo&pretty=true", {
        method: "GET"
    }).then(res => res.json())
        .then(image => {
            console.log(image);
            const img = image.hits[0].largeImageURL;
            const bg = document.querySelector(".image");
            bg.style.backgroundImage = `url(${img})`
        });
}
)();