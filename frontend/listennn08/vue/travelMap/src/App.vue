<template>
	<div id="app">
		<icon-tag />
		<nav-Component :collapse="collapseFn" />
		<search-and-insert @returnMapData="getMapData" :collapse="collapseFn" @calendarData="getCalendarData"/>
		<calendar :cur="date" :dayOfPeople="dayOfPeople" v-if="dayOfPeople.length>0" />
		<main-map :passdata="mapData" />
	</div>
</template>

<script>
import MainMap from './components/MainMap'
import SearchAndInsert from './components/searchAndInsert'
import navComponent from './components/nav'
import IconTag from './components/IconTag'
import calendar from './components/calendar'
import jQuery from 'jquery';
import "bootstrap";
import "bootstrap/dist/css/bootstrap.css";

export default {
	name: 'App',
	components: {
		calendar,
		IconTag,
		navComponent,
		MainMap,
		SearchAndInsert,
	},
	data () {
		return {
			mapData: {},
			dayOfPeople: [],
			date: new Date(),
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
		getCalendarData() {
			this.dayOfPeople = arguments[0];
		},
		collapse() {
			jQuery('#searchAndInsert').toggleClass('open');
			jQuery('#map').toggleClass('open');
			jQuery('#icon-tag').toggleClass('open');
			if (jQuery('#searchAndInsert').hasClass('calendar-show')) {
				jQuery('#searchAndInsert').toggleClass('calendar-show');
				jQuery('#calendar').toggleClass('hide');
			}

		}
	}
}
</script>

<style lang="sass" scope>
@import url("https://fonts.googleapis.com/css?family=Noto+Sans+TC:100,300,400,500,700,900&display=swap")
$large-screen: 1920px
$larges-screen: 1919px
$mid-screen: 1440px
$mids-screen: 1439px
$normal-screen: 1280px
$normals-screen: 1279px
$small-screen: 1025px
$smalls-screen: 1024px
$pc-media: 960px
$pcs-media: 959px
$pad-media: 760px
$pads-media: 759px
$phone-media: 480px
$phones-media: 479px
$miniphone-media: 321px
$miniphones-media: 320px
@mixin large-width()
	@media (min-width:$large-screen)
		@content
@mixin mid-width()
	@media (min-width:$mid-screen) and (max-width:$larges-screen)
		@content
@mixin normal-width()
	@media (min-width:$normal-screen) and (max-width: $mids-screen)
		@content
@mixin small-width()
	@media (min-width: $small-screen) and (max-width: $normals-screen)
		@content
@mixin pc-width()
	@media (min-width:$pc-media) and (max-width: $smalls-screen)
		@content
@mixin pad-width()
	@media (min-width:$pad-media) and (max-width: $pcs-media)
		@content
@mixin pads-width()
	@media (min-width:$phone-media) and (max-width: $pads-media)
		@content
@mixin phone-width()
	@media (min-width: $miniphone-media) and (max-width: $phones-media)
		@content
@mixin miniphone-width()
	@media (max-width: $miniphones-media)
		@content
*
	padding: 0
	margin: 0

#app
	font-family: 'Noto Sans TC', 'Avenir', Helvetica, Arial, sans-serif
	-webkit-font-smoothing: antialiased
	-moz-osx-font-smoothing: grayscale
	width: 100vw
	height: 100vh
	color: #2c3e50

.icon-tag
	position: absolute
	z-index: 9999
	transition: all .5s
	width: 100%
	text-align: center
	bottom: 0px
	&.open
		float: bottom
	@include normal-width
		bottom: 2%
	@include small-width
		bottom: 2%
	@include pc-width
		bottom: 2%
	@include pad-width
		bottom: 2%
	@include pads-width
		bottom: 2%
	@include phone-width
		bottom: 2%
	

#icon-tag .img-block
	@include pads-width
		img
			width: 15px

		.small
			display: none
			font-size: 16px
	@include phone-width
		h6
			display: none
	@include miniphone-width
		img
			width: 10px
		h6
			display: none
		.small
			font-size: 10px



#nav
	position: fixed
	z-index: 9999
	top: 0

.searchAndInsert
	float: left
	overflow: hidden
	position: absolute
	transition: all .5s

	& .top-div
		display: none

	&.open .top-div
		display: inline-block

	@include large-width
		width: 25%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 9999
		&.calendar-show
			left: 25%

	@include mid-width
		width: 30%
		left: 0

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 9999
		&.calendar-show
			left: 20%

	@include normal-width
		width: 30%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 9999
		&.calendar-show
			left: 35%

	@include small-width
		width: 35%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 9999

		&.calendar-show
			left: 35%

	@include pc-width
		width: 40%

		&.open
			top: 30%
			left: 50%
			transform: translateX(-50%)
			z-index: 9999

		&.calendar-show
			left: 35%

	@include pad-width
		width: 50%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 10000
		&.calendar-show
			left: 25%
			transform: translateY(-35%)

	@include pads-width
		width: 70%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 9999
		
		&.calendar-show
			left: 15%
			transform: translateY(-35%)

	@include phone-width
		width: 100%

		&.open
			top: 5%
			left: 50%
			transform: translateX(-50%)
			z-index: 9999
		&.calendar-show
			display: none

	@include miniphone-width
		float: left
		left: 7%
		width: 100%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 10000
		&.calendar-show
			display: none

.MainMap
	position: relative

.cal-container
	position: absolute
	background: #fff
	padding: 2px
	top: 35%
	bottom: 10%
	left: 50%
	height: 30%
	transform: translateX(-50%)
	transition: all .5s
	z-index: 9999

	&.hide
		display: none
	@include large-width
		width: 15%

	@include mid-width
		width: 20%

	@include normal-width
		left: 65%
		width: 20%

	@include small-width
		left: 800px
		width: 300px
		height: 250px

	@include pc-width
		top: 40%
		left: 75%
		width: 30%
		height: 250px

	@include pad-width
		top: 60%
		width: 40%

	@include pads-width
		top: 60%
		width: 30%

	@include phone-width
		left: 50%
		width: 80%
		height: 40%
		top: 30%

	@include miniphone-width
		width: 90%
		height: 40%
		top: 30%
		
</style>
