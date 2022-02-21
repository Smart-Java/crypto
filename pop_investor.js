var xmlhttp=new XMLHttpRequest();
var output;


setInterval(function (){
    document.getElementById("popInvestorId").style.display = 'block';
    var time = getSeconds();
    if(time == 60){
        document.getElementById("popInvestorId").style.display = 'none';
    } else{
        document.getElementById("popInvestorId").style.display = 'block';
    }
    // xmlhttp.onreadystatechange=function()
    // {
    //     alert('Hello');
    //     if (xmlhttp.readyState==4 && xmlhttp.status==200)
    //     {
    //     output=xmlhttp.responseText;
    //         var data= JSON.parse(output);
    //     let paragraph = '';
        
    //     for (let index = 0; index <= data.Fullname.length; index++) {
        
    //     var row = ` 
    //     <p> ${data.fullname[index].fullname } </p>
    //     `;
    //     paragraph = row;
    //     document.getElementById("popInvestorId").innerHTML= paragraph; 
    //     } 
    //     }
    // }
}, 5000);

xmlhttp.open("GET","pop_investor.php",true);
xmlhttp.send();