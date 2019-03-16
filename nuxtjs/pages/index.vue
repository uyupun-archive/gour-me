<template>
  <div>
    <div class="container">
      <h1 class="text-center">gour.me</h1>
      <div class="graph-area">
        <div class="graph-label-top">がっつり</div>
        <div class="graph" @click="coordinate" />
        <div class="graph-label-right">こってり</div>
      </div>
      <kuimon-card v-if="modalOpen" :foods="food"/>
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
      food:[
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
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100vmin - 60px);
    height: calc(100vmin - 60px);
    cursor: pointer;
    &:before {
      position: absolute;
      content: "";
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 95%;
      height: 1px;
      background: #666;
    }
    &:after {
      position: absolute;
      content: "";
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 1px;
      height: 95%;
      background: #666;
    }
    &-area {
      position: relative;
      border: #ccc solid 3px;
    }
    &-label {
      &-top {
        text-align: center;
      }
      &-right {
        position: absolute;
        top: 50%;
        right: 2.5%;
        transform: translateY(-50%);
      }
    }
  }
</style>
