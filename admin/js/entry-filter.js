function filterUsers(event, role) {
    var selectedElement = event.target;
    var selectedValue = selectedElement.value;
    var xhr = new XMLHttpRequest();
    if (role) {
        var url = "get-user-list.php?role=" + encodeURIComponent(role) + "&filter=" + encodeURIComponent(selectedValue);
        xhr.onreadystatechange = function () {
            console.log(xhr.responseText);
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('table-body').innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", url, true);
        xhr.send();
    }
}

function filterProperties(event, isStatus, ref) {
    var selectedElement = event.target;
    var selectedValue = selectedElement.value;
    var xhr = new XMLHttpRequest();
    if (isStatus) {
        var url = "get-property-list.php?status=" + encodeURIComponent(ref) + "&filter=" + encodeURIComponent(selectedValue);
    } else if (ref == "") {
        var url = "get-property-list.php?filter=" + encodeURIComponent(selectedValue);
    } else {
        var url = "get-property-list.php?type=" + encodeURIComponent(ref) + "&filter=" + encodeURIComponent(selectedValue);
    }
    xhr.onreadystatechange = function () {
        console.log(xhr.responseText);
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('table-body').innerHTML = xhr.responseText;
        }
    };
    xhr.open("GET", url, true);
    xhr.send();
}