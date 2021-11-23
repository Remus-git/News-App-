const expendBtn = $('.expend');
const navContainer = $('.mainContainer nav')
const navigation = $('.navBar');
const chevronRight = $('#chevronRight');
const chevronLeft = $('#chevronLeft');
const menus = $(".favourite,.user,.home,.logo,.help,.expend,.logout");
const menuTitle = $(".favourite h1,.logo h1,.user h1,.home h1,.logo h1,.help h1,.expend h1,.logout h1");

const categoryBtn = $('.chevronDown');
const chevronDown = $('#chevronDown');
const chevronUp = $('#chevronUp');
const category = $('.category');

const profileEditBtn = $('.editIcon');
const userProfile = $('.userProfile');
const editUserProfile = $('.editUserProfile');

const postContent = $('.indiPostContent');


/* Expend Nav Bar*/
expendBtn.click(function(e){
   e.preventDefault();
    navContainer.toggleClass('mainNavActive');
    navigation.toggleClass('navBarActive');
    menus.toggleClass('menuActive');
    menuTitle.toggle();
    chevronLeft.toggle();
    chevronRight.toggle();
    console.log(menuTitle);
})

/* toggle ChevronDirection */
categoryBtn.click(function(e){
    e.preventDefault();
    category.toggleClass('categoryActive')
    chevronDown.toggle();
    chevronUp.toggle();
})

/* toggle To Edit Profile */
profileEditBtn.click(function(e){
    e.preventDefault();
    userProfile.toggle();
    editUserProfile.toggle();
})

/* Expend Article Content */
postContent.click(function(e){
    e.preventDefault();
    $(this).toggleClass('postContentExpend');
})


