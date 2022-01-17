// burger menu
function burger_menu(param_insert) {
    // patch the param
    var param = {
        burger_el: '.burger',
        nav_ul: '.nav-links',
        toggle_nav_ul: 'nav-active',
        nav_li: '.nav-links li',
        filterBg: '.bckg-filter',
        toggleBurgerClassName: 'toggle'
    }
    if (typeof param_insert == 'object') {
        for (const key_insert in param_insert) {
            for (const key in param) {
                if (key_insert == key) {
                    param[key] = param_insert[key_insert];
                }
            }
        }
    }

    const burger = document.querySelector(param.burger_el),
        nav = document.querySelector(param.nav_ul),
        navLinks = document.querySelectorAll(param.nav_li),
        filterB = document.querySelector(param.filterBg);



    //toggle nav
    burger.addEventListener('click', () => {
        nav.classList.toggle(param.toggle_nav_ul);
        filterB.classList.toggle(param.toggle_nav_ul);
        // animate links
        navLinks.forEach((link, index) => {
            if (link.style.animation) {
                document.querySelector('body').style.overflowY = 'initial';
                link.style.animation = '';
            } else {
                document.querySelector('body').style.overflowY = 'hidden';
                link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.6}s`;
            }
        });
        //toggle burger
        burger.classList.toggle(param.toggleBurgerClassName)
    });
}

burger_menu();
//toute les les const utilisé pour le player
const controlPanel = document.querySelector('.ctrl-panel'),
    playBtn = document.querySelector('#play'),
    prevBtn = document.querySelector('#prev'),
    nextBtn = document.querySelector('#next'),
    audio = document.querySelector('#audio'),
    progress = document.querySelector('#progress'),
    progressContainer = document.querySelector('#timeline'),
    titles = document.querySelectorAll('.title-item'),
    artists = document.querySelectorAll('.artist-item'),
    titlePlayed = document.querySelector('.title-played'),
    artistPlayed = document.querySelector('.artist-played'),
    album = document.querySelector('.album-name'),
    pgsDuration = document.querySelector('.pgs-duration'),
    musicDuration = document.querySelector('.music-duration'),
    covers = document.querySelectorAll('.music-cover img'),
    musicItems = document.querySelectorAll('.music-item .music-info'),
    coverPlayed = document.querySelector('.cover-played img');

//objet Musics qui permet de maper les info de chaque musique 
class Musics {
    constructor(title, artist, album, file) {
        this.title = title;
        this.artist = artist;
        this.album = album;
        this.file = file;
    }
}

let musicsCalc = [],
    musics = [];
musicItems.forEach((item) => {
    musicsCalc.push(item.parentElement.querySelector('.title-item').textContent)
    let musicsTotal = musicsCalc.length - 1;
    musics.push(new Musics(item.parentElement.querySelector('.title-item').textContent,
        item.parentElement.querySelector('.artist-item').textContent, item.parentElement.querySelector('.music-cover img').src, item.parentElement.querySelector('.src-audio').textContent))
});

let indexOfMusic = musics.length - 1;

//charger la musique(titre cover....)

loadSong(musics[indexOfMusic]);
//function onload pour charger la musique
function loadSong(song) {
    titlePlayed.innerText = song.title
    artistPlayed.innerText = song.artist
    audio.src = song.file;
    coverPlayed.src = song.album;
}

// function changement du bouton play en pause et lancement de la musique
function playSong() {
    controlPanel.classList.add('play');
    playBtn.querySelector('i.fas').classList.remove('fa-circle-play')
    playBtn.querySelector('i.fas').classList.add('fa-circle-pause')
    audio.play()
}
// function changement du bouton pause en play et arret de la musique
function pauseSong() {
    controlPanel.classList.remove('play');
    playBtn.querySelector('i.fas').classList.add('fa-circle-play')
    playBtn.querySelector('i.fas').classList.remove('fa-circle-pause')
    audio.pause()
}
//btn precedent 
function prevSong() {
    indexOfMusic--;
    if (indexOfMusic < 0) {
        indexOfMusic = musics.length - 1;
    }
    loadSong(musics[indexOfMusic]);
    playSong()
}
//btn suivant 
function nextSong() {
    indexOfMusic++;
    if (indexOfMusic > musics.length - 1) {
        indexOfMusic = 0;
    }
    loadSong(musics[indexOfMusic]);

    playSong()
}
// progress bar avec l'animation et le temps reel de la musique
function updateProgress(e) {
    const {
        duration,
        currentTime
    } = e.srcElement;
    const progressPercent = (currentTime / duration) * 100;
    progress.style.width = `${progressPercent}%`;
    let currentTimeMinute = currentTime / 60;
    let durationMinute = duration / 60;
    pgsDuration.innerHTML = currentTimeMinute.toFixed(2);
    musicDuration.innerHTML = durationMinute.toFixed(2);
}
//function timeline click x
function setProgress(e) {
    const width = this.clientWidth,
        clickX = e.offsetX,
        duration = audio.duration;
    audio.currentTime = (clickX / width) * duration;

}

//event Listeners sur le bouton play
playBtn.addEventListener('click', () => {
    const isPlaying = controlPanel.classList.contains('play');
    if (isPlaying) {
        pauseSong()
    } else {
        playSong()
    }
})

// change song events
prevBtn.addEventListener('click', prevSong);
nextBtn.addEventListener('click', nextSong);
//timeline and progress
audio.addEventListener('timeupdate', updateProgress)
progressContainer.addEventListener('click', setProgress)
//fin musique
audio.addEventListener('ended', nextSong)

//pour chaque musique quand on click function anonyme
musicItems.forEach((item, index) => {
    item.addEventListener('click', () => {
        //foreach qui lance la fonction loadsong avec l'index de l'élément cliqué dans l'ob musics
        loadSong(musics[index]);
        console.log(musics[index].title)
        playSong()
    })
});