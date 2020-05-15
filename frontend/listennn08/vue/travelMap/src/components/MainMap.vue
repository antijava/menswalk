<template lang="pug">
    #map.MainMap
        l-map(
            ref="map"
            :zoom="zoom"
            :center="center"
            :options="options"
            style="height: 100vh;"
        )
            l-tile-layer(
                :url="url"
                attribution="attribution"
            )
            l-marker(
                ref="location"
                :lat-lng="center"
            )
                l-popup 你的位置
            l-marker(
                v-for="item in data"
                :lat-lng="item.local"
                :key="item.id"
            )
                l-icon(
                    :icon-url="iconUrl(item.count)"
                    :shadow-url="icon.shdowUrl"
                    :icon-size="icon.iconSize"
                    :icon-anchor="icon.iconAnchor"
                    :popup-anchor="icon.popupAnchor"
                    :shadow-size="icon.shadowSize"
                )
                l-popup
                    h2 {{ item.name }}
                    p(v-if="typeof item.count == 'number'&& passdata.type != 'mw_qrycnt03.php'") 預估觀光人數: {{ item.count }}
                    p(v-if="typeof item.count == 'number' && passdata.type == 'mw_qrycnt03.php'") {{ passdata.date.substring(4,2)}}月預估觀光人數: {{ item.count }}

</template>
<script>
export default {
    data() {
        return {
            data: [],
            zoom: 13,
            center: [22.612961, 120.304167],
            userloc: null,
            url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution: `© <a href="http://osm.org/copyright">OpenStreetMap</a> contributors`,
            options: {
                zoomControl: false,
            },
            icon: {
                type: {
                    black:
                        "https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png",
                    gold:
                        "https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-gold.png",
                    green:
                        "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png",
                    orange:
                        "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-orange.png",
                    red:
                        "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png",
                    yellow:
                        "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png",
                    purple:
                        "https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-violet.png"
                },
                shadowUrl:
                    "https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png",
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            }
        }
    },
    props: {
        passdata: Object,
    },
    watch: {
        passdata: function () {
            console.log(this.passdata)
            this.data = [];
            this.passdata.data.forEach( (el) => {
                this.data.push({
                    id: el.id,
                    name: el.name,
                    local: el.local,
                    count: el.count,
                })
            })
            if (this.passdata.type == "mw_qryspt01.php" || this.passdata.type == "mw_qrycnt02.php") {
                this.center = this.passdata.data[0].local;
            } else if (this.passdata.type == "mw_qryspt02.php" || this.passdata.type == "mw_qrycnt01.php") {
                this.zoom = 12;
                // console.log(this.passdata.region.local)
                this.center = this.passdata.region.local || this.center;
            } else {

            }
        }
    },
    methods: {
        iconUrl(num) {
            return num > 25000
                        ? this.icon.type.purple
                        : num > 20000
                            ? this.icon.type.red
                            : num > 15000
                                ? this.icon.type.orange
                                : num > 10000
                                    ? this.icon.type.yellow
                                    : this.icon.type.green;
        }
    },
    mounted() {
        // 等地圖創建後執行
        this.$nextTick(() => {
        // 獲得目前位置
            navigator.geolocation.getCurrentPosition(position => {
                const p = position.coords;
                // 將中心點設為目前的位置
                this.userloc = [p.latitude, p.longitude] ;
                this.center = [p.latitude, p.longitude] ;
                // 將目前的位置的標記點彈跳視窗打開
                this.$refs.location.mapObject.openPopup();
            }, (error) => {
                this.zoom = 12;
                this.center = [24.05, 120.85];
                // this.$refs.location.mapObject.openPopup();
            });
        });
    }
}
</script>
<style lang="sass" scoped>
html, body
    padding: 0
    margin: 0
</style>
