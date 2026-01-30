const searchInput = document.getElementById("search-box");
const tableBody = document.getElementById("course-table-body");

searchInput.addEventListener("keyup", () => {
    const query = searchInput.value;

    fetch(`search_ajax.php?q=${encodeURIComponent(query)}`)
        .then(response => response.text())
        .then(data => {
            tableBody.innerHTML = data;
        });
});
