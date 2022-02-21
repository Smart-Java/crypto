function copy() {
    var linkToCopy = document.getElementById('linkToCopyId');
    navigator.clipboard.writeText(linkToCopy.value);
    alert(linkToCopy.value + " copied, you can now proceed to payment");
}