export const shortenDetails = (details, maxLength) => {
  if (details.length > maxLength) {
    return details.substring(0, maxLength) + "...";
  }
  return details;
};

export const formatDateTime = (dateTime) => {
  const options = {
    year: "numeric",
    month: "long",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  };
  return new Date(dateTime).toLocaleString(undefined, options);
};
