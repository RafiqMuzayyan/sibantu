let timeout;
const search = document.getElementById('search');
if(search){
    search.addEventListener('input', function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            this.form.submit();
        }, 500);
    });
}