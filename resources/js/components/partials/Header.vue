<template>

  <header>
    <nav>
      <ul>
        <li>
          <router-link :to="{name: 'home'}">Home</router-link>
        </li>
        <li>
          <router-link :to="{name: 'blog'}">Blog</router-link>
        </li>
        <li>
          <router-link :to="{name: 'about'}">Chi siamo</router-link>
        </li>
        <li>
          <router-link :to="{name: 'contacts'}">Contatti</router-link>
        </li>
    </ul>
    </nav>
    
  </header>

</template>

<script>
export default {
  name: 'Header'
}
</script>

<style lang="scss" scoped>
header{
  background-color: cadetblue;
  text-align: center;
  padding: 20px 0;

  ul{
    list-style: none;
    li{
      display: inline-block;
      a{
        margin: 0 10px;
         text-decoration: none;
         color: white;
        &:hover{
          text-decoration: underline;
        } 
        &.active{
          color: crimson;
        }
      }
    }
  }
}
</style>