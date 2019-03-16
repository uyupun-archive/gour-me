<template>
  <div>
    <div class="container">
      <h1 class="text-center">gour.me</h1>
      <div class="chart" style="box-shadow: none;">
        <scatter/>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Scatter from '../plugins/Scatter';

export default {
  components: {
    Scatter
  },
  mounted() {
    this.fetchRecommendData();
  },
  methods: {
    // 座標データを渡してレコメンドを受け取る
    async fetchRecommendData() {
      const { data } = await axios.get('/api/recommend');
      console.log(data);
    }
  }
}
</script>

<style lang="scss" scoped>
  .container {
    max-width: 800px;
    margin: 0 auto;
  }
  .chart {
    padding: 20px;
    box-shadow: 0px 0px 20px 2px rgba(0, 0, 0, .4);
    border-radius: 20px;
    margin: 50px 0;
  }
</style>
