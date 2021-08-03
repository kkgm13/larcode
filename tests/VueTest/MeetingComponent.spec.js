import {mount} from '@vue/test-utils';
import MeetingForm from '../../resources/js/components/AddMeetingComponent.vue';

describe('AddMeeting.vue', () => {
    const wrapper = mount(MeetingForm);
    let titleInput = wrapper.find('input#title');
    let durationInput = wrapper.find('input#duration');
    let startInput = wrapper.find('input#start');
        
    it('Sees expected Title value for meetItem model', () => {
        titleInput.setValue('Meeting 1');
        durationInput.setValue(60);
        startInput.setValue("2021-08-12T15:30")
        submitForm(wrapper);
        expect(wrapper.vm.meetItem.title).toBe("Meeting 1")
    });
    it('Sees expected Starting Date value for meetItem Model', () => {
        titleInput.setValue('Testing Meeting');
        durationInput.setValue(30);
        startInput.setValue("2021-08-10T16:30")
        submitForm(wrapper)
        expect(wrapper.vm.meetItem.start).toBe("2021-08-10T16:30")
    });
    it('Sees expected Duration value for meetItem Model', () => {
        titleInput.setValue('Testing Meeting');
        durationInput.setValue(30);
        startInput.setValue("2021-08-10T16:30")
        submitForm(wrapper)
        expect(wrapper.vm.meetItem.duration).toBe("30")
    });
});

function submitForm(wrapper) {
    wrapper.find('input.btn-success').trigger('click');
}
