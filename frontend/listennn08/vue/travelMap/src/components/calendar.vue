<template lang="pug">
	#calendar.cal-container
		.top-div: button.btn-small.btn-outline-dark(@click="collapse") X
		.calendar
			.header
				button(@click="changeMonth('prev')") &lt;&lt;
				button {{ cal.year }} / {{ cal.month }}
				button(@click="changeMonth('next')") &gt;&gt;
			.label(v-for="label in labels") {{ label }}
			.day(v-for="days in cal.days" :class="`${days.c ? days.c + ' ' : ''}dayn${days.d} `") {{ days.d }}
</template>
<style lang="sass" scoped>
	$large-screen: 1920px
	$larges-screen: 1919px
	$mid-screen: 1440px
	$mids-screen: 1439px
	$normal-screen: 1280px
	$normals-screen: 1279px
	$pc-media: 960px
	$pcs-media: 959px
	$pad-media: 760px
	$pads-media: 759px
	$phone-media: 480px
	$phones-media: 479px
	@mixin large-width()
		@media (min-width:$large-screen)
			@content
	@mixin mid-width()
		@media (min-width:$mid-screen) and (max-width:$larges-screen)
			@content
	@mixin normal-width()
		@media (min-width:$normal-screen) and (max-width: $mids-screen)
			@content
	@mixin pc-width()
		@media (min-width:$pc-media) and (max-width: $normals-screen)
			@content
	@mixin pad-width()
		@media (min-width:$pad-media) and (max-width: $pcs-media)
			@content
	@mixin pads-width()
		@media (min-width:$phone-media) and (max-width: $pads-media)
			@content
	@mixin phone-width()
		@media (max-width: $phones-media)
			@content
	.cal-container
		& .top-div
			position: fixed
			width: 25
			top: 0
			right: 0
			left: 90%
			// left: inherit
			padding: 1%
			// button
			// 	background: none
			// 	outline: 0

	.calendar
		width: 100%
		height: 100%
		border: 1px solid #ddddff
		text-align: center
		display: grid
		grid-template-columns: repeat(7, 1fr)
		justify-content: center
		transition: all .5s


		.header
			grid-column: 1 / span 7
		button
			background: none
			border: 1px solid #fff
			outline: 0px
		button:hover
			border: 1px solid #fdf
		.label
			// display: inline-block
			// margin-left: 4%
			// margin-right: 4%
		.day
			// margin: 1px
			text-align: center
			width: 100%
			height: 100%
			@include pc-width
				margin: .5px
				width: 100%
				height: 100%
			@include pad-width
				margin: .5px
				width: 100%
				height: 100%
			@include pads-width
				margin: .3px
				width: 100%
				height: 100%
			@include phone-width
				width: 100%
				height: 100%
		.day.purple
			background-color: #800060
		.day.red
			background-color: #8b0000
		.day.orange
			background-color: #ffbf00
		.day.yellow
			background-color: #ffbf00
		.day.green
			background-color: #79ff2f
</style>
<script>
import { addMonths, isLeapYear, startOfMonth, format } from 'date-fns';
import jQuery from 'jquery';
import axios from 'axios';
export default {
	data() {
		return {
			labels: [ "日", "一", "二", "三", "四", "五", "六" ],
			days: [0,31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
			cal: {
				year: null,
				month: null,
				datys: null,
			},
			today: this.cur,
			curr: this.cur,
			peopleCount: null
		}
	},
	props: {
		cur: Date,
		dayOfPeople: Array
	},
	created() {
		this.cal.year = this.curr.getFullYear();
		this.cal.month = this.curr.getMonth()+1;
		this.cal.days = this.getDates();
	},
	watch: {
		dayOfPeople() {
			this.cal.days = this.getDates();
		},
		curr() {
			this.cal.year = this.curr.getFullYear();
			this.cal.month = this.curr.getMonth()+1;
			this.cal.days = this.getDates();
		},
	},
	methods: {
		changeMonth(type) {
			switch(type) {
				case 'prev':
					this.curr = addMonths(this.curr, -1);
					break;
				case 'next':
					this.curr = addMonths(this.curr, 1);
					break;
			}
			this.$emit('date', this.curr);
		},
		getDates() {
			let dayLength = isLeapYear(this.curr) && this.cal.month == 2
				? this.days[this.cal.month] +1
				: this.days[this.cal.month]
			let dates = Array.from({length: dayLength}, (_, i) => i+1);
			let startDay = new Array(startOfMonth(this.curr).getDay()).fill('');
			dates = startDay.concat(dates)
			if (this.dayOfPeople.length > 0) {
				return dates.map( (el) => {
					return {
						d: el,
						c: this.getColor(this.dayOfPeople[el-1])
					}
				})
			} else {
				return dates.map( (el) => {
					return {
						d: el,
						c: null
					}
				})
			}
		},
		getColor(num) {
			if (typeof num != 'number') return '';
			return  num > 25000
						? 'purple'
						:num > 20000
							? 'red'
							: num > 15000
								? 'orange'
								: num > 10000
									? 'yellow'
									: 'green';
		},
		collapse() {
			jQuery('#calendar').toggleClass('hide')
			jQuery('#searchAndInsert').toggleClass('calendar-show')
		},
	}
}
</script>

