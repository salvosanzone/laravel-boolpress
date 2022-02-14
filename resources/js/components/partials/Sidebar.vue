<template>
  <div class="container-filter">
    <div class="title-text">
      <h1>Filtra per</h1>
    </div>
      <div class="box">
        <h5>Categoria</h5>
        <button 
          v-for="category in categories"
          :key="`cat${category.id}`"
          class="btn-category">
          {{ category.name }}

        </button>
      </div>

      <div class="box">
        <h5>Tag</h5>
        <button 
          v-for="tag in tags"
          :key="`tag${tag.id}`"
          class="btn-tag">
          {{ tag.name }}
        </button>
      </div>
  </div>

</template>

<script>
export default {
  name: 'Sidebar',

  props: {
  'categories' : Array,
  'tags' : Array
  }
};



</script>

<style lang="scss" scoped>
.container-filter{
  .title-text{
    text-align: center;
  }
    margin-left: 20px;
    .box{
      padding: 10px;
      text-align: center;
      margin-bottom: 20px;
    }
    button{
      border: none;
      padding: 5px;
      border-radius: 5px;
      cursor: pointer;
      color: white;
      margin: 5px;
    }
      
      .btn-category{
        background-color:coral;
        &:hover{
          background-color:rgb(255, 215, 200);
        }
      }
      .btn-tag{
        background-color: lightgreen;
        &:hover{
          background-color:rgb(206, 241, 206);
        }
      }
  }
</style>