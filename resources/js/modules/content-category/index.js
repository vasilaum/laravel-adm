/**
 * Destroy the data from the database based on the send id
 */
$(".btn-content-category-destroy").click(function() {
    const dataID = $(this).val();

    axios.delete("content-categories/" + dataID).then((response) => {
        window.location.reload();

    }).catch((err) => {
        var errMsg = "";

        if(err.response.data.errors !== undefined && !$.isEmptyObject(err.response.data.errors)) {
            for (const [key, value] of Object.entries(err.response.data.errors)) {
                errMsg += value + "\n\r";
            }

            alert(errMsg);
        } else {
            alert(err.response.data.message);
        }
    });
});