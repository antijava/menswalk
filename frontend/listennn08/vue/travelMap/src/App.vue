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
			z-index: 10000


	@include mid-width
		width: 30%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 10000

	@include normal-width
		width: 30%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 10000

	@include small-width
		width: 35%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 10000

	@include pc-width
		width: 40%

		&.open
			top: 20%
			left: 50%
			transform: translateX(-50%)
			z-index: 10000

		&.calendar-show
			left: 5%
			width: 50%
	@include pad-width
		width: 50%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 10000
	@include pads-width
		width: 80%

		&.open
			top: 25%
			left: 50%
			transform: translateX(-50%)
			z-index: 10000
	@include phone-width
		width: 100%

		&.open
			top: 5%
			left: 50%
			transform: translateX(-50%)
			z-index: 10000
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
	z-index: 9999

	&.hide
		display: none

	@include phone-width
		padding: 2px
		left: 10%
		width: 80%
		height: 30%
		bottom: 10%
		top: 30%

	@include miniphone-width
		padding: 2px
		left: 5%
		width: 90%
		height: 40%
		bottom: 10%
		top: 30%
		top: 30%

// @media screen and (min-width: 1920px)

// 		.cal-container
// 			background: #fff
// 			padding: 2px
// 			width: 15%
// 			height: 30%
// 			position: absolute
// 			bottom: 10%
// 			right: 30%
// 			left: 6%
// 			z-index: 9999

// @media screen and (min-width: 1440px) and (max-width: 1919px)
// 		// .icon-tag
// 		// 	left: 50%
// 		// 	transform: translateX(-50%)
// 		// 	bottom: 0px


// 		.cal-container
// 			background: #fff
// 			padding: 2px
// 			width: 20%
// 			height: 30%
// 			position: absolute
// 			bottom: 5%
// 			right: 30%
// 			left: 2%
// 			z-index: 9999

// @media screen and (min-width: 1025px) and (max-width: 1439px)


// 	.icon-tag
// 		left: 50%
// 		transform: translateX(-50%)
// 		bottom: 0px

// 		// &.open
// 		// 	transform: translateX(0%)
// 		// 	transition: transform .5s

// 	.cal-container
// 		background: #fff
// 		padding: 2px
// 		width: 20%
// 		height: 30%
// 		position: absolute
// 		bottom: 5%
// 		right: 30%
// 		left: 6%
// 		z-index: 9999

// @media screen and (max-width: 1024px) and (min-width: 960px)


	// .MainMap
	// 	float: bottom
	// 	width: 100%
	// 	transition: margin-top .5s

		// &.open
		// 	margin-top: 50%

// 	.icon-tag
// 		width: 100%
// 		text-align: center
// 		bottom: 0px

// 	.cal-container
// 		position: absolute
// 		width: 40%
// 		bottom: 5%
// 		top: 10%
// 		// right: 20%
// 		left: 58%
// 		z-index:  10000

// @media screen and (max-width: 960px) and (min-width: 761px)

	// .MainMap
	// 	float: bottom
	// 	width: 100%
	// 	transition: margin-top .5s

	// 	&.open
	// 		margin-top: calc(75% - 8vw)

// 	.icon-tag
// 		right: 0
// 		text-align: center
// 		width: 100%
// 		height: 2%
// 		// transform: translateX(-100%)

// 	.cal-container
// 		position: absolute
// 		width: 35%
// 		bottom: 5%
// 		top: 10%
// 		right: 30%
// 		left: 60%
// 		z-index:  10000

// @media screen and (max-width: 760px) and (min-width: 641px)

	// .MainMap
	// 	float: bottom
	// 	width: 100%
	// 	transition: margin-top .5s

	// 	&.open
	// 		margin-top: 80%

// 	.icon-tag
// 		right: 50
// 		text-align: left
// 		width: 80%
// 	// transform: translateX(-100%)

// 	.cal-container
// 		position: absolute
// 		bottom: 5%
// 		top: 10%
// 		right: 30%
// 		left: 60%

// @media screen and (max-width: 640px) and (min-width: 501px)


	// .MainMap
	// 	float: bottom
	// 	width: 100%
	// 	transition: margin-top .5s

	// 	&.open
	// 		margin-top: 100%

// 	.cal-container
// 		position: absolute
// 		bottom: 5%
// 		top: 10%
// 		right: 30%
// 		left: 60%

// @media screen and (max-width: 500px) and (min-width: 401px)

// 	.icon-tag
// 		bottom: 60px
// 		right: 0
// 		width: 43%
// 		height: 10%

// 	#icon-tag .img-block
// 		img
// 			width: 15px

// 		.small
// 			font-size: 16px

// 	.cal-container
// 		position: absolute
// 		bottom: 5%
// 		top: 10%
// 		right: 30%
// 		left: 60%

// @media screen and (max-width: 400px) and (min-width: 321px)


// 	.icon-tag
// 		bottom: 10px
// 		right: 0
// 		width: 55%
// 		height: 10%

// 	.cal-container
// 		position: absolute
// 		bottom: 5%
// 		top: 10%
// 		right: 30%
// 		left: 60%

// @media screen and (max-width: 320px)


	// .icon-tag
	// 	bottom: 10px
	// 	right: 0
	// 	width: 60%
	// 	height: 10%

	// .cal-container
	// 	position: absolute
	// 	bottom: 5%
	// 	top: 10%
	// 	right: 30%
	// 	left: 60%

</style>
