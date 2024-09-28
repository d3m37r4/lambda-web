import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import toast from '@/Store/toast';

export function useAuthToken(form) {
    const generatingAuthToken = ref(false);

    const generateAuthToken = () => {
        if (generatingAuthToken.value) return;

        generatingAuthToken.value = true;
        router.reload({
            only: ['auth_token'],
            preserveState: true,
            preserveScroll: true,
            onSuccess: (page) => {
                form.auth_token = page.props.auth_token;
                toast.add({
                    status: 'success',
                    message: 'Новый токен успешно сгенерирован.',
                });
                generatingAuthToken.value = false;
            },
            onError: () => {
                generatingAuthToken.value = false;
            },
        });
    };

    return {
        generatingAuthToken,
        generateAuthToken,
    };
}
