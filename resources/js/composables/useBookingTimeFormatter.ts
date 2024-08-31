import { DateTime } from 'luxon';

/**
 * @internal It's good to know that the dates will be outputted in the user's timezone.
 */
const useBookingTimeFormatter = (from: Date, to: Date): string => {
    const startTime = DateTime.fromJSDate(from);
    const endTime = DateTime.fromJSDate(to);

    // We assume that the booking time does not overlap between days.
    return startTime.toFormat('EEEE d MMMM y, H:mm') + ' to ' + endTime.toFormat('H:mm');
}

export default useBookingTimeFormatter;
