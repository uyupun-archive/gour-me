<template>
  <div>
    <div class="graph" @click="coordinate" />
  </div>
</template>

<script>
  import axios from 'axios';

  export default {
    data() {
      return {
        x: 0,
        y: 0
      }
    },
    async mounted() {

    },
    methods: {
      coordinate(e) {
        let rect = e.target.getBoundingClientRect()
        this.x = e.clientX - rect.left
        this.y = e.clientY - rect.top
        console.log(this.x, this.y, "座標")
      },
      // // 座標データを渡してレコメンドを受け取る
      // async fetchRecommendData() {
      //   const { data } = await axios.get('/api/recommend');
      //   console.log(data);
      // }
    }
  }
</script>

<style lang="scss" scoped>
  .graph {
    margin: 0;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100vmin - 60px);
    height: calc(100vmin - 60px);
    background: #000;
  }
</style>
