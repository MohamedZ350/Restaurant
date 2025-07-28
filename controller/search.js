const search = document.getElementById("search");
const btnAll = document.getElementById('btnAll') ;
const cards = document.querySelectorAll('.recipe-title') ; 
search.addEventListener("input" , function(){

    let searchInput = this.value.toLocaleLowerCase() ;
  
    cards.forEach(function(card){
        let content = card.textContent.toLocaleLowerCase() ;
        if(content.includes(searchInput)){
            card.parentElement.style.display = 'block' ;
        }else{
            card.parentElement.style.display = 'none' ;
        }
    })
})

btnAll.addEventListener('click' , function(){
    search.value = '' ; 
    cards.forEach(cd =>{
        cd.parentElement.style.display = "block" ; 
    })
})