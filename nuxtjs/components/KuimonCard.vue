<template>
  <div>
    <h2>名前:<span>{{kuimon.name}}</span></h2>
    <h2>都道府県:<span>{{kuimon.prefecture}}</span></h2>
    <h2>特徴:<span>{{kuimon.description}}</span></h2>
    <h2>こってり度:<span>{{kuimon.kotteri_level}}</span></h2>
    <h2>がっつり度:<span>{{kuimon.gatturi_level}}</span></h2>
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
