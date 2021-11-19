// variables
var Trend1 = $('.trends .first.img')
var Trendtext1 =  $('.trends .first.img .view')
var Trend2 = $('.trends .second.img')
var Trendtext2 =  $('.trends .second.img .view')
var Trend3= $('.trends .third.img')
var Trendtext3 =  $('.trends .third.img .view')
var BrowsePics = document.querySelectorAll('#browse .featured .img')
var BrowseView = document.querySelectorAll('#browse .featured .img .view')
var AllButton = document.querySelector('#browse .browser .All')
var MenButton = document.querySelector('#browse .browser .Men')
var WomenButton = document.querySelector('#browse .browser .Women')
var KidsButton = document.querySelector('#browse .browser .Kids')
var SearchText = document.getElementById('searchtext')
var Searchbar = document.getElementById('searchbar')
var SearchForm = document.getElementById('searchform')
var SearchSubmit = document.getElementById('searchsubmit')
var Suggestions = document.getElementById('suggestions')
var SuggestionsValues = document.querySelectorAll('#suggestions li')
Trend1.mouseenter(function(){
    Trendtext1.show()
})
Trend1.mouseleave(function(){
    Trendtext1.hide()
})
Trend2.mouseenter(function(){
    Trendtext2.show()
})
Trend2.mouseleave(function(){
    Trendtext2.hide()
})
Trend3.mouseenter(function(){
    Trendtext3.show()
})
Trend3.mouseleave(function(){
    Trendtext3.hide()
})
// Browse
for(let i=0;i<BrowsePics.length;i++){
BrowsePics[i].addEventListener('mouseenter',function(){
    BrowseView[i].style.display = 'block'
})
BrowsePics[i].addEventListener('mouseleave',function(){
    BrowseView[i].style.display = 'none'
})
}
function HideByType(Type){
    var Invisible = document.querySelectorAll(`#browse .featured .${Type}`)
    for (let index = 0; index < Invisible.length; index++) {
        Invisible[index].classList.add('hidden')
    }
}
function ShowByType(Type){
    var visible = document.querySelectorAll(`#browse .featured .${Type}`)
    for (let index = 0; index < visible.length; index++) {
        visible[index].classList.remove('hidden')
    }
}
AllButton.addEventListener('click',function(){
    MenButton.classList.remove('active')
    WomenButton.classList.remove('active')
    KidsButton.classList.remove('active')
    AllButton.classList.add('active')
    ShowByType('Men')
    ShowByType('Women')
    ShowByType('Kids')
})
MenButton.addEventListener('click',function(){
    MenButton.classList.add('active')
    WomenButton.classList.remove('active')
    KidsButton.classList.remove('active')
    AllButton.classList.remove('active')
    HideByType('Women')
    HideByType('Kids')
    ShowByType('Men')
})
WomenButton.addEventListener('click',function(){
    MenButton.classList.remove('active')
    WomenButton.classList.add('active')
    KidsButton.classList.remove('active')
    AllButton.classList.remove('active')
    HideByType('Men')
    HideByType('Kids')
    ShowByType('Women')
})
KidsButton.addEventListener('click',function(){
    MenButton.classList.remove('active')
    WomenButton.classList.remove('active')
    KidsButton.classList.add('active')
    AllButton.classList.remove('active')
    HideByType('Men')
    HideByType('Women')
    ShowByType('Kids')
})
SearchText.addEventListener('keyup',function(){
    if(SearchText.value==""){
        Suggestions.classList.add('hidden')
        Searchbar.style.height = '40px'
        Searchbar.style.borderRadius = '40px'
    }
    else{
        Suggestions.classList.remove('hidden')
        Searchbar.style.height = 'fit-content'
        Searchbar.style.borderRadius = '5px'
    }
})   
for (let index = 0; index < SuggestionsValues.length; index++) {
    SuggestionsValues[index].addEventListener('click',function(){
        SearchText.value = SuggestionsValues[index].innerHTML
})    
}
SearchSubmit.addEventListener('click',function(e){
    e.preventDefault()
    SearchForm.submit()
})
