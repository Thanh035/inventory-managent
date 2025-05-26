export class Account {
  constructor(
    public roles: string[],
    public name: string,
    public email: string,
    public profileImageId: string
  ) {}
}

export interface SecurityInfoDTO {
  loginHistories:Array<LoginHistoryDTO> | null;
  roles: string[] | null;
}

export interface LoginHistoryDTO {
  signInIp: string;
  signInAt: string;
  signInBrowser: string;
}

export interface UserUpdateRequest {
  fullname: string;
  phoneNumber: string;
}
