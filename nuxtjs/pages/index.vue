<template>
  <div>
    <div class="container">
      <h1 class="text-center">gour.me</h1>
      <graph/>
      <kuimon-card v-bind:kuimon="kuimon[0]"/>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Graph from '~/components/Graph'
import KuimonCard from '~/components/KuimonCard'

export default {
  components: {
    Graph,
    KuimonCard
  },
  data() {
    return {
      kuimon:[
        {
          "name": "たこやき",
          "prefecture": "大阪府",
          "description": "丸い",
          "img": "",
          "kotteri_level": 15,
          "gatturi_level": 3
        }
      ]
    }
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
    padding: 0 30px;
  }
</style>
