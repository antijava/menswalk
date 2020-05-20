<template>
    <div id="app">
        <icon-tag />
        <nav-Component :collapse="collapseFn" />
        <search-and-insert @returnMapData="getMapData" :collapse="collapseFn" />
        <main-map :passdata="mapData" />
    </div>
</template>

<script>
import MainMap from './components/MainMap'
import SearchAndInsert from './components/searchAndInsert'
import navComponent from './components/nav'
import IconTag from './components/IconTag'

import jQuery from 'jquery';
import "bootstrap";
import "bootstrap/dist/css/bootstrap.css";

export default {
    name: 'App',
    components: {
        IconTag,
        navComponent,
        MainMap,
        SearchAndInsert,
    },
    data () {
        return {
            mapData: {},
            collapseFn: null,
        }
    },
    computed: {
        getWindowWidth() {

        }
    },
    created() {
        this.collapseFn = this.collapse;
        let curpath = window.location.href;
        // let curpath = 'http://menswalk.prjlife.com/listennn08.html'

        let href = !~curpath.indexOf('localhost')
            ? !~curpath.indexOf('https')
                ? curpath.replace(/http/,' https')
                : ''
            : '';
    
        if (href) window.location.href = href;
    },
    methods: {
        getMapData() {
            this.mapData = arguments[0];
        },
        collapse() {
            jQuery('#searchAndInsert').toggleClass('open');
            jQuery('#map').toggleClass('open');
            jQuery('#icon-tag').toggleClass('open');
        }
    }
}
</script>

<style>
@import url("https://fonts.googleapis.com/css?family=Noto+Sans+TC:100,300,400,500,700,900&display=swap");

@media screen and (min-width: 1025px) {
    .searchAndInsert {
        float: left;
        left: 5%;
        width: 0;
        transition: width .5s;
    }
    .searchAndInsert.open {
        width: 30%;
    }
    .MainMap {
        float: right;
        width: 100%;
        height: 100%;
        transition: width .5s;
    }
    .MainMap.open {
        width: 60%;

    }
    .icon-tag {
        left: 50%;
        transform: translateX(-50%);
    }
    .icon-tag.open {
        transform: translateX(50%);
        transition: transform .5s;
    }
}
@media screen and (max-width: 1024px) and (min-width: 960px) {
    .searchAndInsert {
        float: top;
        top: 2%;
        left: 20%;
        width: 60%;
        height: 0;
        transition: height .5s;
    }
    .searchAndInsert.open {
        height: 70%;
    }
    .MainMap {
        float: bottom;
        width: 100%;
        transition: margin-top .5s;
    }
    .MainMap.open {
        margin-top: 50%;
    }
    .icon-tag {
        width: 100%;
        text-align: center;
    }
}
@media screen and (max-width: 960px) and (min-width: 761px) {
     .searchAndInsert {
        float: top;
        top: 1%;
        left: 20%;
        width: 60%;
        height: 0;
        transition: height .5s;
    }
    .searchAndInsert.open {
        height: 70%;
    }
    .MainMap {
        float: bottom;
        width: 100%;
        transition: margin-top .5s;
    }
    .MainMap.open {
        margin-top: calc(75% - 8vw);
    }
    .icon-tag {
        right: 0;
        text-align: center;
        width: 100%;
        height: 2%;
        /* transform: translateX(-100%); */
    }
}
@media screen and (max-width: 760px) and (min-width: 641px){
     .searchAndInsert {
        float: top;
        top: 1%;
        left: 20%;
        width: 60%;
        height: 0;
        transition: height .5s;
    }
    .searchAndInsert.open {
        height: 90%;
    }
    .MainMap {
        float: bottom;
        width: 100%;
        transition: margin-top .5s;
    }
    .MainMap.open {
        margin-top: 80%;
    }
    .icon-tag {
        right: 50;
        text-align: left;
        width: 80%;
        /* transform: translateX(-100%); */
    }
}
@media screen and (max-width: 640px) and (min-width: 501px) {
     .searchAndInsert {
        float: top;
        top: 0;
        left: 0;
        width: 100%;
        height: 0;
        transition: height .5s;
    }
    .searchAndInsert.open {
        height: 70%;
    }
    .MainMap {
        float: bottom;
        width: 100%;
        transition: margin-top .5s;
    }
    .MainMap.open {
        margin-top: 100% ;
    }
}
@media screen and (max-width: 500px) and (min-width: 401px) {
    .searchAndInsert.open {
        height: 70%;
    }
    .MainMap.open {
        margin-top: 120% ;
    }
    .icon-tag {
        bottom: 60px;
        right: 0;
        width: 43%;
        height: 10%;
    }
    #icon-tag .img-block img {
        width: 15px;
    }
    #icon-tag .img-block .small  {
        font-size: 16px;
    }
}
@media screen and (max-width: 400px) and (min-width: 321px) {
    .searchAndInsert {
        float: top;
        top: 0;
        left: 0;
        width: 100%;
        height: 0;
        transition: height .5s;
    }
    .searchAndInsert.open {
        height: 80%;
    }
    .MainMap.open {
        margin-top: 135% ;
    }
    .icon-tag {
        bottom: 10px;
        right: 0;
        width: 55%;
        height: 10%;
    }
}
@media screen and (max-width: 320px) {
    .searchAndInsert {
        float: top;
        top: 0;
        left: 0;
        width: 100%;
        height: 0;
        transition: height .5s;
    }
    .searchAndInsert.open {
        height: 90%;
    }
    .MainMap.open {
        margin-top: 150% ;
    }
    .icon-tag {
        bottom: 10px;
        right: 0;
        width: 60%;
        height: 10%;
    }
}
* {
    padding: 0;
    margin: 0;
}
#app {
    font-family: 'Noto Sans TC', 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    width: 100vw;
    height: 100vh;
    color: #2c3e50;
}
.icon-tag {
    position: fixed;
    z-index: 9999;
    transition: transform .5s;
}

#nav {
    position: fixed;
    z-index: 9999;
    top: 0;
}
.searchAndInsert {
    overflow: hidden;
    position: absolute;
}
.MainMap {
    position: relative;
}
</style>
