<template lang="pug">
    #icon-tag.icon-tag
        .img-block(v-for=" image in images")
            img(:src="image.url", :alt="image.name + 'icon'")
            h6.discription
                span {{ image.discription }}
            span.small {{ image.discription }}
</template>

<script>
export default {
    data() {
        return {
            images: [
                {
                    name: 'green',
                    url: './static/marker-icon-green.png',
                    discription: '可旅遊'
                }, 
                {
                    name: 'yellow',
                    url: './static/marker-icon-yellow.png',
                    discription: '可旅遊，須保持距離'
                },
                {
                    name: 'orange',
                    url: './static/marker-icon-orange.png',
                    discription: '建議避免旅遊'
                },
                {
                    name: 'red',
                    url: './static/marker-icon-red.png',
                    discription: '避免旅遊'
                },
                // {
                //     name: 'purple',
                //     url: './static/marker-icon-violet.png',
                //     discription: '避免旅遊'
                // }
            ]
        }
    }
}
</script>
<style lang="sass" scoped>
    $pc-media: 960px
    $pcs-media: 959px
    $pad-media: 760px
    $pads-media: 759px
    $phone-media: 480px
    $phones-media: 479px
    @mixin pc-width()
        @media (min-width:$pc-media)
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
    *
        padding: 0
        margin: 0
        overflow: none
    .icon-tag
        // text-align: center
        background: none
    .img-block
        position: abusolute
        top: 20px
        display: inline-block
        margin: 2px
        img
            @include pc-width
                
            @include pad-width
                
            @include pads-width
            @include phone-width
                width: 10px
        .discription
            display: inline-block
            margin: 5px
            text-align: center
            font-weight: bold
            // background: rgba(240, 240, 240, 60)
        .discription span
            background-color: rgba(240, 240, 240, 60)
            @include phone-width
                display: none
        .small
            background-color: rgba(240, 240, 240, 60)

            @include pc-width
                display: none
            @include pad-width
                display: none
            @include pads-width
            @include phone-width
                font-size: 10px

        
</style>
