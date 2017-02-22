<template >
    <div class="component-autocomplete">
      <div class="autocomplete-input">
          <p class="control has-icon has-icon-right">
            <input
              class="input is-large"
              placeholder="Search..."
            >
            <span class="icon is-small">
              <i class="fa fa-angle-down"></i>
            </span>
          </p>
          <ul class="options-list">
            <li v-for="option in options">
              <slot name="item"
                :title="option.title"
                :description="option.description"
                :thumbnail="option.thumbnail"
              >
            </li>
          </ul>
        </div>
    </div>
</template>


<script>
    module.exports = {
        data(){
            return{
                msg:'Hello world!'
            }
        },

        props: {
                options: {
                    type: Array,
                    required: true
                }
        },
        data(){
            return {

             }
        },
        mounted: function() {
            console.log('product search component ready...');
        },
    }
</script>