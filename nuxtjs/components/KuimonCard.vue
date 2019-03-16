<template>
  <div>
    <div v-for="food in kuimon" :key="index">
    <h2>名前:<span>{{food.name}}</span></h2>
    <h2>都道府県:<span>{{food.prefecture}}</span></h2>
    <h2>特徴:<span>{{food.description}}</span></h2>
    <h2>こってり度:<span>{{food.kotteri_level}}</span></h2>
    <h2>がっつり度:<span>{{food.gatturi_level}}</span></h2>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log(this.kuimon)
  },
  props: {
    kuimon: {
      type: Object,
      default: () => ({})
    }
  }
}
</script>

<style lang="scss" scoped>
</style>
