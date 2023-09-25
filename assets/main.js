document.querySelector("#searchForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const maMonHoc = document.querySelector("#maMonHoc").value;
    const tenMonHoc = document.querySelector("#tenMonHoc").value;

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const resultTable = document.querySelector("#tableResult");
            resultTable.innerHTML = xhr.responseText;
            document.querySelector("#ketQuaTimKiem").classList.remove("hidden");
        }
    };

    xhr.open("POST", "search.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`maMonHoc=${maMonHoc}&tenMonHoc=${tenMonHoc}`);
});