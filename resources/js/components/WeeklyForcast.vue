<template>
<div>
  <p>test</p>
</div>
</template>
<script>
export default {
    name: "WeeklyForcast",
    props:["daily"],
    created(){
      console.log(this.daily);
    }
}
</script>
