var count = 1;
    var countEl = document.getElementById("count");
  
    function plus(){
      if(count < 20){
        count++;
        countEl.value = count;
      }
    }

    function minus(){
      if (count > 1) {
        count--;
        countEl.value = count;
      }  
    }