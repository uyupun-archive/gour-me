<template>
  <div>
    <div class="container">
      <h1 class="text-center">gour.me</h1>
      <div class="graph" @click="coordinate" />
      <kuimon-card v-if="modalOpen" :foods="kuimon"/>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import KuimonCard from '~/components/KuimonCard'

export default {
  components: {
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
        },
      ],
      display: false
    }
  },
  computed: {
    modalOpen() {
      if (this.display) {
        return this.display
      }
    }
  },
  methods: {
    // 座標データを渡してレコメンドを受け取る
    async fetchRecommendData() {
      const { data } = await axios.get('/api/recommend');
      console.log(data);
    },
    coordinate(e) {
      let rect = e.target.getBoundingClientRect()
      this.x = e.clientX - rect.left
      this.y = e.clientY - rect.top
      console.log(this.x, this.y, "座標")
      this.display = true
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
