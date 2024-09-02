import { DateTime } from 'luxon';

export default (date: Date): string => {
    return DateTime.fromJSDate(date).toFormat('EEEE d MMMM y');
}
