<script setup>
import { ref, onMounted } from 'vue';
import TomSelect from 'tom-select';

const props = defineProps({
    id: String,
    name: String,
    placeholder: String,
	modelValue: String,
});

const emit = defineEmits(['update:modelValue']);

onMounted(() => {
  var settings = {
		valueField: 'moneybird_id',
		searchField: ['first_name','last_name', 'company_name', 'email', 'phone', 'city'],
        placeholder: props.placeholder,
		onChange: function(value) {
			emit('update:modelValue', value);
			props.modelValue = value;
		},
		// fetch remote data
		load: function(query, callback) {
			var url = '/api/moneybird-test?q=' + encodeURIComponent(query);
			fetch(url)
				.then(response => response.json())
				.then(json => {
					callback(json);
				}).catch(()=>{
					callback();
				});
		},
		render: {
			option: function(item, escape) {
        let title = item.first_name + " " + item.last_name;
        if(item.company_name) {
          title = item.company_name
        }

        item.city = item.city === "" ? "Onbekend" : item.city;

				return `<div class="row border-bottom py-2">
							<div class="col-md-11">
								<div class="mt-0">${escape(title)}
									<span class="small text-muted">${escape(item.email)}</span>
								</div>
								<div class="mb-1"><i class="bi bi-geo"></i> ${escape(item.city)}</div>
								<div class="d-flex text-muted">
								</div>
							</div>
						</div>`;
			},
			item: function(item, escape) {
        let title = item.first_name + " " + item.last_name;
        if(item.company_name) {
          title = item.company_name
        }
				return `<div class="py-2 d-flex">
							<div>
								<div class="mb-1">
									<span class="h4">
										${ escape(title) }
									</span>
									<span class="text-muted">${ escape(item.email) }</span>
								</div>
						 		<div class="description">
                  <i class="bi bi-geo"></i> ${ escape(item.city) }
                </div>
							</div>
						</div>`;
			}

		}
	};



  new TomSelect("#" + props.id, settings);
})


</script>
<style src="node_modules/tom-select/dist/css/tom-select.bootstrap5.css"></style>

<template>
    <select :id="id" class="js-select form-select" :name="name" autocomplete="off"></select>
</template>