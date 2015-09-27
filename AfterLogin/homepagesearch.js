

function homePageSearchBegin(str){
    if(str.length==0){
        $("#mySelect").remove();
        return;
    }else{


        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){

            if(xmlhttp.readyState==4 && xmlhttp.status==200){

                $("#mySelect").remove();
                var addselecthere = document.getElementById("searchresult");
                var select = document.createElement("SELECT");
                select.setAttribute("onchange","this.form.submit()");
                select.setAttribute("id", "mySelect");
                select.setAttribute("name","searchProfile");
                //select.setAttribute("class","dropdown-menu");





                $("#mySelect").empty();

                var length = select.options.length;
                for (i = 0; i <= length; i++) {
                    select.options[i] = null;
                }

                addselecthere.appendChild(select);
                select.className = select.className +" form-control";

                var results=xmlhttp.responseText.split('|');

                results.forEach(function(option){
                    var element = document.createElement("option");
                    element.text=option;
                    select.add(element);
                });



                $('#mySelect').click();
            }
        };

        xmlhttp.open("GET", "homepagesearch.php?q=" + str,true);

        xmlhttp.send();
    }
}