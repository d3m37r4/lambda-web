import { trans } from 'laravel-vue-i18n';

export const getGenderName = (gender, separator = '-') => {
    if (!gender?.name) {
        return trans('gender.name.unknown');
    }

    const formattedgenderName = gender.name.toLowerCase().replace(/\s+/g, separator);
    const translation = trans(`gender.name.${formattedgenderName}`);

    return translation === `gender.name.${formattedgenderName}` ? gender.name : translation;
};
