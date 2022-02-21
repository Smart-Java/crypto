function pictureCompare(picture1, picture2, buttonLinkId, firstAccessory, secondAccessory, contactUs){
    
    var oPicture1 = document.getElementById(picture1);
    var oPicture2 = document.getElementById(picture2);
    var oBtnLink = document.getElementById(buttonLinkId);
    var oText1 = document.getElementById(firstAccessory);
    var oText2 = document.getElementById(secondAccessory);
    var oContact = document.getElementById(contactUs);

    oBtnLink.style.visibility = "hidden";
    oBtnLink.style.textAlign = "center";

    oText1.innerText = "First Accessory"
    oText2.innerText = "Second Accessory"

    oContact.onclick = function(){
        if (confirm("Are you sure you want to leave the game to contact us? The contact form will open in a new tab.")) {
            var oWindow = window.open("contactUs.html", "_blank", null, null, false);
            if(oWindow == null){
                alert("Your popup blocker won’t allow you access to this window");
            }else{
                oWindow
            }
        }else{
            // cancel
        }
    }

    // checking for the first pictures
    oPicture1.onclick = function () {
        if (oPicture1.getAttribute("alt") == "pictureTrue") {
            
            oPicture1.style.display = "none";
            oText1.style.display = "none";
            // alert("Amazing, that's the right accessory dear. " + "\n" + "Click the next button to play");
            this.disabled = true;
            oBtnLink.style.visibility = "visible";
            oBtnLink.style.textAlign = "center";
            oText2.innerText = "Wrong Accessory";
            oBtnLink.style.marginTop = "10px";

            oPicture2.onpointerover = function (){
                if (oBtnLink.style.visibility = "visible") {
                    alert("Use the next button to play the next accessory match");   
                }
            }
            oPicture2.onpointerdown = function (){
                if (oBtnLink.style.visibility = "visible") {
                    alert("Use the next button to play the next accessory match");   
                }
            }
        }else{
           // alert("Oh, you are wrong dear." + "\n" + "Use the next button after this to play the next accessory match.");
            this.disabled = true;
            oBtnLink.style.visibility = "visible";
            oBtnLink.style.textAlign = "center";
            oBtnLink.style.marginTop = "10px";

            oPicture2.onpointerover = function (){
                if (oBtnLink.style.visibility = "visible") {
                    alert("Use the next button to play the next accessory match, you got it wrong this time.");   
                }
            }
            oPicture2.onpointerdown = function (){
                if (oBtnLink.style.visibility = "visible") {
                    alert("Use the next button to play the next accessory match, you got it wrong this time.");   
                }
            }
        }
        return this.disabled = true;
    }

    oPicture2.onclick = function (){
         if (oPicture2.getAttribute("alt") == "pictureFalse") {
             
            // alert("Oh, you are wrong dear." + "\n" + "Use the next button after this to play the next accessory match.");
            this.disabled = true;
            oBtnLink.style.visibility = "visible";
            oBtnLink.style.textAlign = "center";
            oBtnLink.style.marginTop = "10px";

            oPicture1.onpointerover = function (){
                if (oBtnLink.style.visibility = "visible") {
                    alert("Use the next button to play the next accessory match");   
                }
            }
            oPicture1.onpointerdown = function (){
                if (oBtnLink.style.visibility = "visible") {
                    alert("Use the next button to play the next accessory match, you got it wrong this time.");   
                }
            }
         }else{
            oPicture2.style.display = "none";
            oText2.style.display = "none";
           // alert("Amazing, that's the right accessory dear." + "\n" + "Click the next button to play");
            this.disabled = true;
            oBtnLink.style.visibility = "visible";
            oBtnLink.style.textAlign = "center";
            oText1.innerText = "Wrong Accessory";
            oBtnLink.style.marginTop = "10px";

            oPicture1.onpointerover = function (){
                if (oBtnLink.style.visibility = "visible") {
                    alert("Use the next button to play the next accessory match.");   
                }
            }
            oPicture1.onpointerdown = function (){
                if (oBtnLink.style.visibility = "visible") {
                    alert("Use the next button to play the next accessory match, you got it wrong this time.");   
                }
            }
         }
         return this.disabled = true;
    } 

    if (oBtnLink.style.visibility == "visible") {
        alert("Use the next button to play the next accessory match, you got it wrong this time.");
    }
    
    // determining browser
    var nua = navigator.userAgent 
    var isAndroid = (nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1 && nua.indexOf('Chrome') === -1) 
    if (isAndroid) { 
    $('select.form-control').removeClass('form-control').css('width', '100%') 
    }
}

