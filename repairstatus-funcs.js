//Javascript functions for Repair Status Main Script
//Copyright (c) 2014, Chris Formeister. All Rights Reserved.

function allnumeric(inputtxt)  
   {  
      var numbers = /^[0-9]+$/;  
      if(inputtxt.value.match(numbers))  
      {  
      return true;  
      }  
      else  
      {  
      alert('You must enter your Invoice number using numeric characters only.');  
      document.invInfo.invid.focus();  
      return false;  
      }  
   } 

function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}

function openInfo() {
var viewportwidth = document.documentElement.clientWidth;
var viewportheight = document.documentElement.clientHeight;
window.resizeBy(-300,0);
window.moveTo(0,0);

window.open("/repairstatus_info.htm",
            "statusInfo",
            "width=450,left="+(viewportwidth-300)+",top=0");
}
