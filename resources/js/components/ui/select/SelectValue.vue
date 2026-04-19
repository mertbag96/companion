<script setup lang="ts">
import type { SelectValueProps } from "reka-ui"
import { SelectValue } from "reka-ui"

const props = defineProps<SelectValueProps>()
</script>

<template>
  <SelectValue
    data-slot="select-value"
    v-bind="props"
  >
    <template #default="slotProps">
      <slot v-bind="slotProps">
        <template v-if="slotProps.selectedLabel?.length">
          {{ slotProps.selectedLabel.join(', ') }}
        </template>
        <template v-else>
          {{ props.placeholder }}
        </template>
      </slot>
    </template>
  </SelectValue>
</template>
