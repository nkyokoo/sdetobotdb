
let themeState = 'light';

let themeSwitcher = () => {

 if(themeState === 'light'){

     $('#dayNightSwitcherIcon').html('brightness_5');
     $("body").css("background","var(--dark-bg-color");

      themeState = 'dark';

 }else if(themeState === 'dark'){
     $('#dayNightSwitcherIcon').html('brightness_3');
     $("body").css("background","var(--light-bg-color");

      themeState = 'light';

 }


}