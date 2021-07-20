import { mount } from '@vue/test-utils';
import Counter from '../../resources/js/components/Counter.vue';

describe('Counter.vue', () => {
    it('increments counter', () => {
        const wrapper = mount(Counter);

        expect(wrapper.vm.counter).toBe(0);

        wrapper.find('button').trigger('click')

        expect(wrapper.vm.counter).toBe(1);
    })
})