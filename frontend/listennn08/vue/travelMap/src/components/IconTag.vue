<template lang="pug">
    #icon-tag.icon-tag
        .img-block(v-for=" image in images")
            img(:src="image.url", :alt="image.name + 'icon'")
            h3 {{ image.discription }}
</template>

<script>
export default {
    data() {
        return {
            images: [
                {
                    name: 'green',
                    url: './static/marker-icon-green.png',
                    discription: ''
                },
                {
                    name: 'purple',
                    url: './static/marker-icon-violet.png',
                },
                {
                    name: 'yellow',
                    url: './static/marker-icon-yellow.png',
                },
                {
                    name: 'orange',
                    url: './static/marker-icon-orange.png',
                },
                {
                    name: 'red',
                    url: './static/marker-icon-red.png',
                }
            ]
        }
    }
}
</script>
<style lang="sass" scoped>
    .icon-tag
        text-align: center
        background: none
    .img-block
        display: inline-block
        margin: 2px
</style>
