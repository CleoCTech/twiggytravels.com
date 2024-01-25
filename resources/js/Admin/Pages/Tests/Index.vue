<template>
  <div class="field">
    <p class="help is-danger" v-for="message in errors" :key="message">
      {message}
    </p>
    <div class="control" :class="'has-text-' + alignment">
      <template  v-for="(entry, index) in entries" :key="index">
        <label class="checkbox"  >
          <input
            type="checkbox"
            :name="name"
            :value="entry.value"
            v-model="model"
          />
          {{ entry.label }}
        </label>
        <br v-if="block" :key="'br_' + entry.value" />
      </template>
    </div>
  </div>
</template>

<script>
//read from: https://codesandbox.io/s/component-with-multiple-checkboxes-and-one-v-model-879hy?file=/src/App.vue
//and this: https://stackoverflow.com/questions/59128724/component-with-multiple-checkboxes-and-one-v-model
export default {
  name: "CheckboxGroup",
  props: {
    name: String,
    alignment: String,
    block: Boolean,
    entries: Array,
    errors: Array,
    value: Array,
  },
  computed: {
    model: {
      get() {
        return this.value;
      },
      set(newValue) {
        this.$emit("input", newValue);
      },
    },
  },
};
</script>
