
        var Category = document.getElementsByName('category').value;
        console.log(Category[0]);
        var Main_type = response['Main_type'];
        var Query = "select option[value='" +Main_type + "']"
        var Query2 = "select option[value='" +Category + "']"
        $(Query2).attr("selected","selected")
        $(Query2).attr("selected","selected")

