<template>
  <div>
    <h1 class="text-center">gour.me</h1>
  </div>
</template>

<script>
import axios from 'axios';

export default {
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

<style lang="scss" scoped></style>
